<?php
declare(strict_types=1);

namespace App\Controller;

use App\DTO\UserData;
use Doctrine\DBAL\Connection;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/")
     *
     * @return Response
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    public function indexAction(Request $request): Response
    {
        $errors = [];

        if ($request->isMethod('post')) {
            $userData = new UserData();
            $userData
                ->setFirstName($request->request->get('firstname'))
                ->setLastName($request->request->get('lastname'))
                ->setEmail($request->request->get('email'))
                ->setActive(true);

            $errors = $this->validateUserData($userData);

            if (count($errors) === 0) {
                $this->get('users_repository')->save($userData);

                return $this->render('registration/registrationSucess.html.twig');
            }
        }

        return $this->render('registration/index.html.twig', [
            'errors' => $errors
        ]);
    }

    /**
     * @param UserData $userData
     *
     * @return array
     */
    private function validateUserData(UserData $userData): array
    {
        $errors = [];

        if (empty($userData->getFirstName())) {
            $errors[] = 'First name cannot be empty.';
        }

        if (empty($userData->getLastName())) {
            $errors[] = 'Last name cannot be empty.';
        }

        if (empty($userData->getEmail())) {
            $errors[] = 'E-mail cannot be empty.';
        } else {
            $emailValidator = new EmailValidator();
            $isValid        = $emailValidator->isValid($userData->getEmail(), new RFCValidation());

            if ($isValid === false) {
                $errors[] = 'E-mail is not valid.';
            }
        }

        return $errors;
    }
}
