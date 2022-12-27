<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Contact;
use App\Entity\Order;
use App\Repository\OrderRepository;
use App\Service\OrdersData;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateOrdersController extends AbstractController
{

    public function __construct(private OrdersData $ordersData,private EntityManagerInterface $entityManager, private OrderRepository $orderRepository)
    {
    }
    #[Route('/create/orders', name: 'app_create_orders')]
    public function index()
    {
//        return $this->render('create_commandes/index.html.twig', [
//            'controller_name' => 'CreateCommandesController',
//        ]);

        $commandes = $this->ordersData->getCommandes();
        $this->contactsData = $this->ordersData->getContacts();

        foreach ($commandes as $key=>$commandeData) {
            $existingEntity = $this->orderRepository->findOneByOrderId($commandeData['OrderID']);

            if ($existingEntity === null) {
                $commande = new Order();
                $contact = new Contact();

                $id = $commandeData['DeliverTo'];
                $currentContact = array_filter($this->contactsData, function ($item) use ($id) {
                    return $item['ID'] == $id;
                });

                $currentContact = reset($currentContact);

                $contact->setIDContact($currentContact['ID']);
                $contact->setContactName($currentContact['ContactName']);
                $contact->setAccountName($currentContact['AccountName']);
                $contact->setCity($currentContact['City']);
                $contact->setCountry($currentContact['Country']);
                $contact->setAddressLine1($currentContact['AddressLine1']);
                $contact->setAddressLine2($currentContact['AddressLine2']);
                $contact->setZipCode($currentContact['ZipCode']);
                $commande->setCurrency($commandeData['Currency']);
                $commande->setAmount($commandeData['Amount']);
                $commande->setOrderNumber($commandeData['OrderNumber']);
                $commande->setOrderID($commandeData['OrderID']);
                $this->entityManager->persist($commande);

                $commande->setDeliverTo($contact);
                foreach ($commandeData['SalesOrderLines']['results'] as $key => $articleData) {
                    $article = new Article();

                    $article->setOrderID($commande);
                    $article->setAmount($articleData['Amount']);
                    $article->setDescription($articleData['Description']);
                    $article->setItem($articleData['Item']);
                    $article->setItemDescription($articleData['ItemDescription']);
                    $article->setUnitCode($articleData['UnitCode']);
                    $article->setUnitDescription($articleData['UnitDescription']);
                    $article->setUnitPrice($articleData['UnitPrice']);
                    $article->setDiscount($articleData['Discount']);
                    $article->setVATAmount($articleData['VATAmount']);
                    $article->setVATPercentage($articleData['VATPercentage']);
                    $article->setQuantity($articleData['Quantity']);
                    $this->entityManager->persist($article);
                }
                $this->entityManager->persist($commande);

            }

        }
        $this->entityManager->flush();
// Renvoyer une réponse au client
        return $this->render('create_orders/index.html.twig');

    }
}
