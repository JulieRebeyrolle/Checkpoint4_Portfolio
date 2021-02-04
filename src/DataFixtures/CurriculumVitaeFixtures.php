<?php

namespace App\DataFixtures;

use App\Entity\CurriculumVitae;
use App\Entity\CvCategory;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CurriculumVitaeFixtures extends Fixture implements DependentFixtureInterface
{
    private const CV = [
        'Cesem' => [
            'name' => 'BBA in European Management',
            'place' => 'RMS - Lancaster University',
            'startingDate' => ['01', '09', '2004'],
            'endingDate' => ['30', '06', '2008'],
            'resume' => 'Vergentem quoniam petivere per maiora munimentum usque nec circumstetere omne ipsa et discrimine ipsa ullum.',
            'category' => 'formation'
        ],
        'EAV' => [
            'name' => 'Assistante de production',
            'place' => 'EAV Productions',
            'startingDate' => ['01', '02', '2011'],
            'endingDate' => ['01', '03', '2012'],
            'resume' => 'Vergentem quoniam petivere per maiora munimentum usque nec circumstetere omne ipsa et discrimine ipsa ullum.',
            'category' => 'job'

        ],
        'afpa' => [
            'name' => 'BTS Opérateur de prises de vues vidéo',
            'place' => 'Afpa Issoudun',
            'startingDate' => ['30', '08', '2013'],
            'endingDate' => ['30', '06', '2014'],
            'resume' => 'Vergentem quoniam petivere per maiora munimentum usque nec circumstetere omne ipsa et discrimine ipsa ullum.',
            'category' => 'formation'
        ],
        'r2' => [
            'name' => 'Chargée de projets vidéo',
            'place' => 'Agence r2',
            'startingDate' => ['01', '02', '2014'],
            'endingDate' => ['30', '05', '2014'],
            'resume' => 'Vergentem quoniam petivere per maiora munimentum usque nec circumstetere omne ipsa et discrimine ipsa ullum.',
            'category' => 'job'

        ],
        'Visu' => [
            'name' => 'Chargée de projets vidéo',
            'place' => 'Visu communication',
            'startingDate' => ['01', '02', '2017'],
            'endingDate' => ['30', '06', '2017'],
            'resume' => 'Vergentem quoniam petivere per maiora munimentum usque nec circumstetere omne ipsa et discrimine ipsa ullum.',
            'category' => 'job'

        ],
        'AE' => [
            'name' => 'Chargée de projets vidéo',
            'place' => 'Freelance',
            'startingDate' => ['30', '08', '2014'],
            'endingDate' => ['30', '08', '2018'],
            'resume' => 'Réalisation de vidéos corporate. Références client : OPPBTP (GRTGaz, SPIE), VIDELIO (Ville de Reims, Commission Européenne), Visu Communication (Groupama, Cerba, Conforama), Agence r2 (Royal Canin)',
            'category' => 'job'
        ],
        'Koala' => [
            'name' => 'Cadreuse / monteuse',
            'place' => 'Koala interactive',
            'startingDate' => ['01', '11', '2018'],
            'endingDate' => ['30', '08', '2020'],
            'resume' => 'Vergentem quoniam petivere per maiora munimentum usque nec circumstetere omne ipsa et discrimine ipsa ullum.',
            'category' => 'job'
        ],
        'wcs' => [
            'name' => 'Titre Développeur Web et Web Mobile',
            'place' => 'Wild Code School',
            'startingDate' => ['11', '09', '2020'],
            'endingDate' => ['12', '06', '2021'],
            'resume' => 'Formation intensive au développement web / spécialisation PHP - Symfony - Retrouvez les projets réalisés dans la partie portfolio',
            'category' => 'formation'
        ],
    ];

    public function load(ObjectManager $manager)
    {

        foreach (self::CV as $label => $data) {
            $cv = new CurriculumVitae();
            $cv->setTitle($data['name']);
            $cv->setPlace($data['place']);
            $cv->setStartingDate((new DateTime())
                ->setDate(
                    (int)$data['startingDate'][2],
                    (int)$data['startingDate'][1],
                    (int)$data['startingDate'][0]
                )
                ->setTime(0, 0, 0));
            $cv->setEndingDate((new DateTime())
                ->setDate(
                    (int)$data['endingDate'][2],
                    (int)$data['endingDate'][1],
                    (int)$data['endingDate'][0]
                )
                ->setTime(0, 0, 0));
            $cv->setResume($data['resume']);

            if ($data['category'] === 'job') {
                $cv->setCategory($this->getReference('category_' . 1));
            } elseif ($data['category'] === 'formation') {
                $cv->setCategory($this->getReference('category_' . 0));
            }
            $manager->persist($cv);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [CvCategoryFixtures::class];
    }
}
