<?php

namespace App\Repository;

use App\Entity\Oferta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Oferta|null find($id, $lockMode = null, $lockVersion = null)
 * @method Oferta|null findOneBy(array $criteria, array $orderBy = null)
 * @method Oferta[]    findAll()
 * @method Oferta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfertaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Oferta::class);
    }
/* 
    CORREGIR ERRORES EN ESTA FUNCIÓN

    public function buscarOfertasEmpresario()
    {
        return $this->getEntityManager()
            ->createQuery(dql: '
                SELECT oferta.cif, oferta.id_comercio, oferta.descripcion, oferta.fecha_inicio, oferta.fecha_fin, oferta.img_oferta
                FROM App:Oferta oferta, App:Comercio comercio, App:Empresa empresa, App:Empresario empresario
                WHERE oferta.cif = comercio.cif AND oferta.id_comercio = comercio.id_comercio AND comercio.cif = empresa.cif
                AND empresa.id_usuario = empresario.id_usuario')->getResult();
    }
*/
    // /**
    //  * @return Oferta[] Returns an array of Oferta objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Oferta
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
