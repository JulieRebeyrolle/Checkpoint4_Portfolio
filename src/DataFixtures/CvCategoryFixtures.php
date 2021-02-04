<?php

namespace App\DataFixtures;

use App\Entity\CvCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CvCategoryFixtures extends Fixture
{
    private const CV_CATEGORIES = [
        'formation' => [
            'name' => 'Formation',
            'label' => 'formation',
        ],
        'job' => [
            'name' => 'Experience',
            'label' => 'job',
        ]
    ];
    public function load(ObjectManager $manager)
    {

        $index = 0;
        foreach (self::CV_CATEGORIES as $label => $data) {
            $category = new CvCategory();
            $category->setName($data['name']);
            $category->setLabel($data['label']);
            $manager->persist($category);
            $this->addReference('category_' . $index, $category);
            $index++;
        }

        $manager->flush();
    }
}
