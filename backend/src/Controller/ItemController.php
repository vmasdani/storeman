<?php

namespace App\Controller;

use App\Entity\Item;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ItemController extends AbstractController
{
    #[Route('/items', name: 'items')]
    public function all(
        EntityManagerInterface $em,
        SerializerInterface $s

    ) {
        return new Response($s->serialize($em->getRepository(Item::class)->findAll(), 'json'));
    }

    #[Route('/items-save', name: 'items-save', methods: ['GET'])]
    public function save(
        EntityManagerInterface $em,
        SerializerInterface $s,
        Request $r
    ) {
        $item = $s->deserialize($r->getContent(), Item::class, 'json');
        $found = $em->getRepository(Item::class)->find($item->getId());

        if ($found) {
            $found->merge($item);
        } else {
            $found = $item;
        }

        $em->persist($found);
        $em->flush();

        return new Response('Saved new Item with id ' . $found->getId());

    }
    #[Route('/items-save-dummy', name: 'items-save', methods: ['GET'])]
    public function saveDummy(
        EntityManagerInterface $em,
        SerializerInterface $s,
        Request $r
    ) {
        $item = new Item();
        $item->setName('item name ' . uniqid());
        $item->setDescription('item desc ' . uniqid());
        $item->setUm('item um ' . uniqid());

        $em->persist($item);
        $em->flush();

        return new Response('Saved new Item with id ' . $item->getId());

    }

}