<?php

namespace Cocktails\RecipesBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * RecipesIngredientsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RecipesIngredientsRepository extends EntityRepository
{
    public function getFilterIngredients($data)
    {
        $em = $this->getEntityManager();
        $where = "";
        if($data != "")
            $where = "WHERE i.ingredient IN ($data)";

        $query = $em->createQuery(
            "
                            SELECT r
                            FROM Cocktails\RecipesBundle\Entity\Recipe r
                            INNER JOIN r.ingredients i
                            $where
                            ORDER BY r.name ASC


                        "
        );
        //$recipes = $query->getResult();
        return $query;

    }
}
