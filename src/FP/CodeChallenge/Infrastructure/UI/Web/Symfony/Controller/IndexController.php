<?php

namespace App\Infrastructure\UI\Web\Symfony\Controller;

use App\Application\Request\UseCase\ClientCert\AddClientCertRequest;
use App\Application\Request\View\ClientCert\ActiveClientCertRequest;
use App\Application\View\ClientCert\ActiveClientCertView;
use App\Application\UseCase\ClientCert\AddClientCertUseCase;
use App\Domain\Model\ClientCert;
use App\Domain\ValueObject\SerialNumber;
use App\Infrastructure\Persistance\Doctrine\Repository\ClientCertRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/home", name="home")
     */
    public function home(): Response
    {
        $serialNumber = SerialNumber::build($_SERVER ["SSL_CLIENT_M_SERIAL"]);
        
        $request = new ActiveClientCertRequest($serialNumber);
        $clientCertRespository = new ClientCertRepository($this->getDoctrine()->getManager());

        $createAction = new ActiveClientCertView($clientCertRespository);

        $activeClientCert = $createAction->execute($request);
        
        if (empty($activeClientCert)) {
            return $this->render('index.html.twig');
        }

        return $this->render('user/home.html.twig', [
            'id' => $activeClientCert->id(),
            'common_name' => $activeClientCert->commonName(),
            'serial_number' => $activeClientCert->serialNumber(),
            'created_at' => $activeClientCert->createdAt(),
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(): Response
    {
        $clientCartData = ClientCert::getData();

        if (!ClientCert::isValid($clientCartData)) {
            return $this->render('security/login.html.twig', [
                'message' => 'El certificado es inválido o no existe',
                'isValid' => false,
            ]);
        }

        $request = AddClientCertRequest::buildFromArray($clientCartData);
        $clientCertRespository = new ClientCertRepository($this->getDoctrine()->getManager());

        $createAction = new AddClientCertUseCase($clientCertRespository);

        $newClientCert = $createAction->execute($request);

        $message = 'El certificado se ha registrado con éxito';

        if (empty($newClientCert)) {
            $message = 'El certificado ya está registrado';
        }
        
        return $this->render('security/login.html.twig', [
            'message' => $message,
            'isValid' => true,
        ]);

        
    }
}