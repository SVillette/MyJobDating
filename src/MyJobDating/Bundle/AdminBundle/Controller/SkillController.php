<?php

namespace MyJobDating\Bundle\AdminBundle\Controller;

use MyJobDating\Bundle\SkillBundle\Entity\Skill;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SkillController extends Controller
{
    /**
     * @param string|null $skillName
     * @return array
     */
    private function getSkills(?string $skillName = ""): array
    {
        return $this->getDoctrine()->getManager()->getRepository(Skill::class)
            ->createQueryBuilder("s")
            ->where("LOWER(s.name) LIKE :name")
            ->setParameter("name", "%" . strtolower($skillName) . "%")
            ->getQuery()
            ->getResult();
    }

    public function indexAction(Request $request): Response
    {
        $myQuery = $request->query;
        $myMethod = $myQuery->get("_method");
        $myMessage = [];

        if ( $myMethod ) {
            switch ($myMethod) {
                case "post": $myMessage = $this->create($myQuery); break;
                case "put": $myMessage = $this->update($myQuery); break;
                case "delete": $myMessage = $this->delete($myQuery); break;
            }
        }

        return $this->render(
            '@MyJobDatingSkill/Skill/index.html.twig',
            [
                "skills" => $this->getSkills($request->query->get("name")),
                "errorMessage" => isset($myMessage["errorMessage"]) ? $myMessage["errorMessage"] : null,
                "successMessage" => isset($myMessage["successMessage"]) ? $myMessage["successMessage"] :  null,
            ]
        );
    }

    //==============
    //     CRUD
    //==============

    /**
     * @param ParameterBag $query
     * @return array
     */
    public function create(ParameterBag $query): array
    {
        $myNewSkillName = $query->get("name");

        if ( !$myNewSkillName ) {
            return ["errorMessage" => "No skill name was provided."];
        }

        $mySkill = new Skill($myNewSkillName);

        $myEntityManager = $this->getDoctrine()->getManager();
        $myEntityManager->persist($mySkill);
        $myEntityManager->flush();

        return ["successMessage" => "Skill '" . $myNewSkillName . "' added with ID '" . $mySkill->getId() . "'."];
    }

    /**
     * @param ParameterBag $query
     * @return array
     */
    public function update(ParameterBag $query): array
    {
        $mySkillToUpdateId = $query->get("id");
        $myNewSkillName    = $query->get("name");

        // Id 0 won't ever exist, simple comparison is safe
        if ( !$mySkillToUpdateId ) {
            return ["successMessage" => "No skill ID was provided."];
        }
        if ( !$myNewSkillName ) {
            return ["errorMessage" => "No new skill name was provided."];
        }

        $myEntityManager = $this->getDoctrine()->getManager();
        $mySkill = $myEntityManager->find(Skill::class, $mySkillToUpdateId);
        $myPreviousSkillName = $mySkill->getName();

        $mySkill->setName($myNewSkillName);
        $myEntityManager->flush();

        return ["successMessage" => "Skill n°$mySkillToUpdateId called '$myPreviousSkillName' has been renamed to '$myNewSkillName'."];
    }

    /**
     * @param ParameterBag $query
     * @return array
     */
    public function delete(ParameterBag $query): array
    {
        $mySkillToDeleteId = $query->get("id");

        if ( $mySkillToDeleteId === null ) {
            return ["errorMessage" => "No skill ID provided."];
        }

        $myManager = $this->getDoctrine()->getManager();
        $mySkill = $myManager->find(Skill::class, $mySkillToDeleteId);

        if ( !$mySkill ) {
            return ["errorMessage" => "Unknown skill ID."];
        }

        $myManager->remove($mySkill);
        $myManager->flush();

        return ["successMessage" => "Skill named '" . $mySkill->getName() . "' has been removed."];
    }
}
