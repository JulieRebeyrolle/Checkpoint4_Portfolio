<?php

namespace App\DataFixtures;

use App\Entity\CvCategory;
use App\Entity\SkillsCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SkillsCategoryFixtures extends Fixture
{
    private const SKILL_CATEGORIES = [
        'back' => [
            'name' => 'Back-End',
            'label' => 'back',
        ],
        'front' => [
            'name' => 'Front-End',
            'label' => 'front',
        ],
        'others' => [
            'name' => 'Autres',
            'label' => 'other',
        ]
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::SKILL_CATEGORIES as $label => $data) {
            $category = new SkillsCategory();
            $category->setName($data['name']);
            $category->setLabel($data['label']);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
