<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Event;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Student
 *
 * @ORM\Table(name="student")
 * @ORM\Entity
 */
class Student
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="github", type="string", length=255)
     */
    private $github;

    /**
     * @var string
     *
     * @ORM\Column(name="project", type="string", length=255)
     */
    private $project;

    /**
     * @Gedmo\Slug(fields={"github"})
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Student
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Student
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set github
     *
     * @param string $github
     * @return Student
     */
    public function setGithub($github)
    {
        $this->github = $github;

        return $this;
    }

    /**
     * Get github
     *
     * @return string 
     */
    public function getGithub()
    {
        return $this->github;
    }

    /**
     * Set project
     *
     * @param string $project
     * @return Student
     */
    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return string 
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Student
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('firstName', new NotBlank());
        $metadata->addPropertyConstraint('lastName', new NotBlank());
        $metadata->addPropertyConstraint('github', new NotBlank());
        $metadata->addPropertyConstraint('project', new NotBlank());

        $metadata->addPropertyConstraint('github', new Assert\Regex(array(
            'pattern'     => '/^[a-z]+$/i',
            'htmlPattern' => '^[a-zA-Z]+$',
        )));

        $metadata->addPropertyConstraint('firstName', new Assert\Length(array(
            'min'        => 2,
            'max'        => 50,
            'minMessage' => 'Your first name must be at least {{ limit }} characters long',
            'maxMessage' => 'Your first name cannot be longer than {{ limit }} characters long',
        )));

        $metadata->addPropertyConstraint('lastName', new Assert\Length(array(
            'min'        => 2,
            'max'        => 50,
            'minMessage' => 'Your first name must be at least {{ limit }} characters long',
            'maxMessage' => 'Your first name cannot be longer than {{ limit }} characters long',
        )));
    }
}
