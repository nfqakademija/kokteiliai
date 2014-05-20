<?php

namespace Cocktails\RecipesBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Cocktails\RecipesBundle\Entity\Recipe;

class LoadRecipeData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $recipes = array();
        for($i = 1; $i< 2; $i++){

            array_push($recipes, array('NEKALTAS MOJITO – NOJITO', 20, 'recipeType-1', '','recipe-'.$i, 'taste-4', '2014-04-06 10:10:12', 'image-1', "Į aukštą taurę sudėkite mėtų lapelius (kelis palikiti papuošimui) ,cukrų ir švelniai pagrūskite grūstuvu. Į plaktuvę su ledo kubeliais supilkite žaliųjų citrinų sultis, cukraus sirupą ir labai gerai suplakite. Į taurę pridėkite grūsto ledo, nukoškite plaktuvės turinį ir kiek lieka vietos – pripildykite imbiero limonadu (Ginger Ale).
Taurę papuoškite likusiais mėtos lapeliais.", 3));
            $i++;
            array_push($recipes, array('ŽALIAS SKANUMĖLIS', 15, 'recipeType-1', '', 'recipe-'.$i, 'taste-1', '2014-03-01 12:55:10', 'image-2', "Visus ingredientus, aukščiau nurodyta tvarka, sudėkite į kokteilinę arba maišytuvą („blenderį“). Maždaug vieną minutę maišykite aukšto tempo rėžimu. Gautą masę supilkite į aukštas arba kokteilines taures.

Su aukščiau nurodytomis proporcijomis galima pagaminti 2-3 kokteilius.", 4));
            $i++;
            array_push($recipes,array('PIENO IR MĖLYNIŲ KOKTEILIS', 7, 'recipeType-5', '', 'recipe-'.$i, 'taste-2', '2014-04-07 18:19:10', 'image-3', "Visus ingredientus sudėkite į kokteilinę arba maišytuvą („blenderį“) ir ~10 sekundžių pamaišykite. Jeigu neturite kokteilinė arba maišytuvo („blenderio“), uogas sudėkite į stiklinę ir pasidarbuokite grūstuvu. Pagal skonį pridėkite cukraus. Gautą turinį supilkite į aukštą arba kokteilinę taurę.", 2));
            $i++;
            array_push($recipes, array('ARBŪZŲ IR ANANASŲ KOKTEILIS', 10, 'recipeType-2', '', 'recipe-'.$i, 'taste-2', '2014-04-02 16:00:05', 'image-4', "Nupjaustykite ananaso ir arbūzo žievę, iš arbūzo pašalinkite sėklas. Sumeskite viską į kokteilinę  arba maišytuvą (blenderį) ir sumeskite ledo kubelius. Maišykite aukštu rėžimu maždaug minutę, išmaišę supilkite į kokteilines taure.", 4));
            $i++;
            array_push($recipes,array('ŠOKOLADINIS BANANINIS KOKTEILIS', 35, 'recipeType-3', '', 'recipe-'.$i, 'taste-1', '2014-04-02 16:00:05', 'image-5', "Visus ingredientus supilkite į plaktuvę su ledo kubeliais, gerai suplakite ir supilkite į aukštą arba kokteilinę taurę.", 5));
            $i++;
            array_push($recipes, array('RAIL SPLITTER', 35, 'recipeType-1', '', 'recipe-'.$i, 'taste-2', '2014-04-02 16:00:05', 'image-6', "Į aukštą taurę, su ledo kubeliais, supilkite cukraus sirupą ir šviežiais spaustas citrinų sultis, gerai sumaišykite.  Kiek lieka vietos – pripildykite imbiero limonadu.
Jeigu pageidaujate, galite kokteilį papuošti citrinos griežinėliu.", 1));
            $i++;
            array_push($recipes, array('BRAŠKINĖ PINA COLADA', 35, 'recipeType-6', '', 'recipe-'.$i, 'taste-4', '2014-04-02 16:00:05', 'image-7', "Visus ingredientus, išskyrus vieną braškę, sudėkite į kokteilinę arba maišytuvą („blenderį“) ir maišykite, kol gausis vientisa, labiau skysta, nei tiršta masė. Supilkite kokteilį į kokteilinę taurę ir papuoškite braške.", 0));
            $i++;
            array_push($recipes,array('LIMONADAS', 35, 'recipeType-1', '', 'recipe-'.$i, 'taste-2', '2014-04-02 16:00:05', 'image-8', "Išspaudžiame citrinas (turėtų pakakti 3-4 stambesnių citrinų) ir supilame į indą, į kurį įpilame litrą šalto vandens. Įpilame cukraus sirupo ir sumetame mėtų lapelius.
Papildomai, į indą, įdedame kelis griežinėlius citrinos ir ledukų. Gerai viską išmaišome ir ragaujame.
Visas turinys, puikiai telpa 1,75 dydžio inde.

Pastaba: Jeigu neturite šviežių mėtų, tinka ir džiovintos, tiesa, skonis nebebus toks gaivus.", 4));
            $i++;
            array_push($recipes,array('Sveikatingumo kokteilis', 0, 'recipeType-2', '', 'recipe-'.$i, 'taste-3', '2014-05-02 16:00:05', 'image-11', "Į stikline dėkite ledo gabaliukus ir užpilkite apelsinų sultimis.", 2));
            $i++;
            array_push($recipes,array('Pieno kokteilis "Pochlebca"', 2, 'recipeType-3', '', 'recipe-'.$i, 'taste-1', '2012-10-02 09:00:05', 'image-12', "Sumaišykite pieną su smulkinto ledo gabalėliais ir kakava. Supilkite į stiklines ir pabarstykite šokolado drožlėmis.

Labai skanu ir paprasta.", 4));
            $i++;
            array_push($recipes,array('Vasariška gaiva', 10, 'recipeType-2', '', 'recipe-'.$i, 'taste-2', '2014-10-09 20:10:05', 'image-13', "Apelsiną ir citriną supjaustome kubeliais.
Vaisius užpilame obuolių sultimis (geriausia naminės). Pridedame ledukų.
Jei sultys rūgščios įmaišome cukraus.", 4));
            $i++;
            array_push($recipes,array('Riešutų sviesto kokteilis', 10, 'recipeType-5', '', 'recipe-'.$i, 'taste-4', '2014-10-09 20:10:05', 'image-14', "Išplakite sutrintą bananą, riešutų sviestą ir pieną. Geriausia plakti mikseriu.
Pridėkite ledukų ir pamaišykite šaukšteliu.
Gaivu ir skanu!", 5));
        }

        foreach($recipes as $recipeTemp){

            $recipe = new Recipe();
            $recipe->setName($recipeTemp[0]);
            $recipe->setRank($recipeTemp[1]);
            $recipe->setRecipeType($this->getReference($recipeTemp[2]));
            $recipe->setRecipeTaste($this->getReference($recipeTemp[5]));
            $recipe->setCreateDate(new \DateTime($recipeTemp[6]));
            $recipe->setImage($this->getReference($recipeTemp[7]));
            $recipe->setDescription($recipeTemp[8]);
            $recipe->setVote($recipeTemp[9]);
            $manager->persist($recipe);
            $this->addReference($recipeTemp[4],$recipe);
        }
        $manager->flush();

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 3;
    }
}