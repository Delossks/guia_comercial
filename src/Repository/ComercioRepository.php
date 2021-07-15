<?php

namespace App\Repository;

use App\Entity\Comercio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comercio|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comercio|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comercio[]    findAll()
 * @method Comercio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComercioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comercio::class);
    }

    //Buscar todos los comercios de un empresario
    public function buscarComerciosEmpresario()
    {
        return $this->getEntityManager()
            ->createQuery(dql: '
                SELECT comercio.cif, comercio.nombre_comercio, comercio.direccion_comercio, comercio.codigo_postal, comercio.telefono_comercio, comercio.web_comercio
                FROM App:Comercio comercio, App:Empresa empresa, App:Empresario empresario
                WHERE comercio.cif = empresa.cif AND empresa.id_usuario = empresario.id_usuario')->getResult();
    }

    //Buscar todos los comercios mostrando sólo la información pública
    public function buscarComercios()
    {
        return $this->getEntityManager()
            ->createQuery(dql: '
                SELECT comercio.nombre_comercio, comercio.direccion_comercio, comercio.codigo_postal, comercio.telefono_comercio, comercio.web_comercio
                FROM App:Comercio comercio')->getResult();
    }

    // /**
    //  * @return Comercio[] Returns an array of Comercio objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Comercio
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
