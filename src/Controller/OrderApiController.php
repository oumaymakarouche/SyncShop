<?php

namespace App\Controller;

use App\Service\OrdersData;
use League\Csv\Writer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderApiController extends AbstractController
{
    public function __construct( private OrdersData $ordersData)
    {
    }
    #[Route( name: 'app_order_to_csv_api')]
    public function __invoke()
    {
        $commandesData = $this->ordersData->getCommandes();
        $contactsData = $this->ordersData->getContacts();

        $csv = Writer::createFromString();
        $csv->insertOne(['Order', 'delivery_name', 'delivery_address', 'delivery_country', 'delivery_zipcode', 'delivery_city','items_count','item_index','item_id','item_quantity','line_price_excl_vat','line_price_incl_vat']);

        foreach ($commandesData as $commandes) {
            $id=$commandes['DeliverTo'];
            $contact=array_filter($contactsData, function($item) use ($id) {
                return $item['ID'] == $id;
            });
            $contact = reset($contact);
            $articles=$commandes['SalesOrderLines']['results'];
            $items_count= count($articles);
            foreach ($articles as $i =>$article) {

                $csv->insertOne([$commandes['OrderNumber'], $contact['ContactName'], $contact['AddressLine1'], $contact['Country'], $contact['ZipCode'], $contact['City'], $items_count,$i+1,$article['Item'],$article['Quantity'],$article['Amount'],$article['Amount']+$article['VATAmount']]);

            }
//            $csv->insertOne($commandes);
        }
        $csv->setOutputBOM(Writer::BOM_UTF8);
        $csv->output('SyncShop.csv');
        die();
    }
}
