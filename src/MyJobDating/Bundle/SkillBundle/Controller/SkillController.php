<?php

namespace MyJobDating\Bundle\SkillBundle\Controller;

use MyJobDating\Bundle\SkillBundle\Entity\Skill;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SkillController extends Controller
{
    public function indexAction(Request $request): Response {
        $myData = [];

        switch ($request->get("_method")) {
            case 'get': $myData = $this->onGet($request); break;
            case 'put': $myData = $this->onPut($request); break;
            case 'delete': $myData = $this->onDelete($request); break;
            case 'post': $myData = $this->onPost($request); break;
        }

        return $this->render(
            '@MyJobDatingSkill/Skill/index.html.twig',
            array_merge(
                [
                    'skills' => $this->getDoctrine()->getRepository(Skill::class)->findAll()
                ],
                $myData
            ),
            new Response("", in_array("errorMessage", array_keys($myData)) ? 400 : 200)
        );
    }

    public function addAction($id){
        return $this->render('@MyJobDatingSkill/Skill/add.html.twig');
    }

    /**
     * @param Request $request
     * @return array
     */
    private function onGet(Request $request): array {
        $myName = $request->query->get('name');

        if ($myName) {
            return $this->findSkills($myName);
        }

        return ["errorMessage" => "Aucun nom / ID n'a été saisi."];
    }

    private function findSkills($name): array {
        $myFoundSkills = $this->getDoctrine()->getRepository(Skill::class)->findBy(["name" => $name]);

        if ( !count($myFoundSkills) ) {
            return ["errorMessage" => "Aucune compétence trouvée avec ce nom."];
        }

        return ['foundSkills' => $myFoundSkills];
    }

    /**
     * @param Request $request
     * @return array
     */
    private function onPost(Request $request): array {
        $mySkillName = $request->query->get("name");
        return $this->createSkill($mySkillName);
    }

    /**
     * @param string|null $skillName
     * @return array
     */
    private function createSkill(?string $skillName): array {
        if ( !$skillName ) {
            return ["errorMessage" => "No skill name provided."];
        }

        $mySkill = new Skill($skillName);

        $myEntityManager = $this->getDoctrine()->getManager();
        $myEntityManager->persist($mySkill);
        $myEntityManager->flush();

        return ["successMessage" => "Skill '" . $skillName . "' added with ID '" . $mySkill->getId() . "'."];
    }

    /**
     * @param Request $request
     * @return array
     */
    private function onPut(Request $request): array {
        $mySkillId = $request->query->get("id");
        $mySkillName = $request->query->get("name");

        return $this->updateSkill($mySkillId, $mySkillName);
    }

    /**
     * @param int|null $skillId
     * @param string|null $skillName
     * @return array
     */
    private function updateSkill(?int $skillId, ?string $skillName): array {
        // Id 0 won't ever exist, simple comparison is safe
        if ( !$skillId ) {
            return ["successMessage" => "No skill ID provided."];
        }
        if ( !$skillName ) {
            return ["errorMessage" => "No skill name provided."];
        }

        $myEntityManager = $this->getDoctrine()->getManager();
        $mySkill = $myEntityManager->find(Skill::class, $skillId);
        $myPreviousSkillName = $mySkill->getName();

        $mySkill->setName($skillName);
        $myEntityManager->flush();

        return ["successMessage" => "Skill n°$skillId called '$myPreviousSkillName' has been renamed to '$skillName'."];
    }

    /**
     * @param Request $request
     * @return array
     */
    private function onDelete(Request $request): array {
        $mySkillId = $request->query->get("id");

        return $this->deleteSkill($mySkillId);
    }

    /**
     * @param int|null $mySkillId
     * @return array
     */
    private function deleteSkill(?int $mySkillId): array {
        if ( $mySkillId === null ) {
            return ["errorMessage" => "No skill ID provided."];
        }

        $myManager = $this->getDoctrine()->getManager();
        $mySkill = $myManager->find(Skill::class, $mySkillId);

        if ( !$mySkill ) {
            return ["errorMessage" => "Unknown skill ID."];
        }

        $myManager->remove($mySkill);
        $myManager->flush();

        return ["successMessage" => "Skill named '" . $mySkill->getName() . "' has been removed."];
    }

}
