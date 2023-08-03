<?php

declare(strict_types=1);

namespace App\Controller\QLS;

use App\QLS\Client\QlsClient;
use App\QLS\Product\Product;
use App\QLS\ShipmentLabel\ShipmentLabelMerger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ShipmentLabelFormController extends AbstractController
{
    public function __construct(
        private QlsClient $qlsClient,
        private ShipmentLabelMerger $shipmentLabelMerger
    ) {
    }

    #[Route('/qls/form', methods: ['GET', 'POST'])]
    public function __invoke(Request $request): Response
    {
        $products = $this->qlsClient->getProducts('9e606e6b-44a4-4a4e-a309-cc70ddd3a103');
        foreach ($products as $key => $product) {
            $combinations = $product->getCombinations();
            if ($combinations === []) {
                unset($products[$key]);
            }
        }

        usort($products, fn(Product $a, Product $b) => $a->getId() <=> $b->getId());

        $choices = array_map(fn ($product) => [$product->getName() => $product->getId()], $products);

        $form = $this->createFormBuilder()
            ->add('product', ChoiceType::class, [
                'choices' => $choices,
            ])
            ->add('save', SubmitType::class, ['label' => 'Create Shipment Label'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('app_qls_createshipmentlabel__invoke', [
                'data' => $form->getData(),
            ]);
        }

        return $this->render('qls/form.html.twig', [
            'form' => $form,
        ]);
    }
}
