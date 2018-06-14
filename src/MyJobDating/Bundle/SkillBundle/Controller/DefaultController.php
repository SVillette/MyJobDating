<?php

namespace MyJobDating\Bundle\SkillBundle\Controller;

use MyJobDating\Bundle\SkillBundle\Entity\Skill;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction(Request $request): Response
    {
        $myRequestMethod = $request->getMethod();

        switch ($myRequestMethod) {
            case 'GET': return $this->onGet();
            case 'POST': return $this->onPost($request);
            case 'PUT': return $this->onPut($request);
            //case 'DELETE': return $this->onDelete($request);
        }

        return new Response("405 - METHOD NOT ALLOWED", 405);
    }

    /**
     * @return Response
     */
    private function onGet(): Response
    {
        return $this->listSkills();
    }

    /**
     * @return Response
     */
    private function listSkills(): Response
    {
        $mySkillsList = $this->getDoctrine()->getRepository(Skill::class)->findAll();

        $mySkillsList = array_map(function(Skill $skill) {
            return [$skill->getId(), $skill->getName()];
        }, $mySkillsList);

        return new Response( json_encode($mySkillsList) );
    }

    /**
     * @param Request $request
     * @return Response
     */
    private function onPost(Request $request): Response
    {
        $mySkillName = $request->request->get("name");
        return $this->createSkill($mySkillName);
    }

    /**
     * @param string|null $skillName
     * @return Response
     */
    private function createSkill(string $skillName = null)
    {
        if ( !$skillName ) {
            return new Response("No skill name provided.", 400);
        }

        $mySkill = new Skill($skillName);

        $myEntityManager = $this->getDoctrine()->getManager();
        $myEntityManager->persist($mySkill);
        $myEntityManager->flush();

        return new Response("Skill '" . $skillName . "' added with ID '" . $mySkill->getId() . "'.");
    }

    /**
     * @param Request $request
     * @return Response
     */
    private function onPut(Request $request): Response
    {
        $mySkillId = $request->request->get("id");
        $mySkillName = $request->request->get("name");
        
        return $this->updateSkill($mySkillId, $mySkillName);
    }

    /**
     * @param int|null $skillId
     * @param string|null $skillName
     * @return Response
     */
    private function updateSkill(int $skillId = null, string $skillName = null)
    {
        // Id 0 won't ever exist, simple comparison is safe
        if ( !$skillId ) {
            return new Response("No skill ID provided.", 400);
        }
        if ( !$skillName ) {
            return new Response("No skill name provided.", 400);
        }

        $mySkill = new Skill($skillId);

        $myEntityManager = $this->getDoctrine()->getManager();
        $myEntityManager->persist($mySkill);
        $myEntityManager->flush();

        return new Response("Skill n°'" . $skillId . "' has been renamed '" . $mySkill->getName() . "'.");
    }

    /**
     * @param Request $request
     * @return Response
     */
    /*private function onDelete(Request $request): Response
    {
        $mySkillId = $request->request->get("id");
        
        return $this->deleteSkill($mySkillId);
    }*/

    // TODO
   /**
     * @param int|null $mySkillId
     * @return Response
     */
   /*
    private function deleteSkill(int $mySkillId = null)
    {
        if ( $mySkillId === null ) {
            return new Response("No skill ID provided.", 400);
        }

        $myManager = $this->getDoctrine()->getManager();
        $mySkill = $myManager->find(Skill::class, $mySkillId);

        if ( !$mySkill ) {
            return new Response("Unknown skill ID.", 400);
        }

        $myManager->remove($mySkill);
        $myManager->flush();

        return new response("Skill named '" . $mySkill->getName() . "' has been removed.");
    }*/

}
