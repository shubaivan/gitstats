<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 23.12.14
 * Time: 22:19
 */
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use AppBundle\Entity\Student;

class LoadJobData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        for ($i=100; $i<=130; $i++)
        {
            $student = new Student();
            $student->setFirstName('Charles', $i);
            $student->setLastName('Darwin');
            $student->setGithub('darvin');
            $student->setProject('evolution');


            $em->persist($student);

        }
        $em->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
