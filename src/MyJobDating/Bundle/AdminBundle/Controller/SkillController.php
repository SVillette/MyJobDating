<?php

namespace MyJobDating\Bundle\AdminBundle\Controller;

use MyJobDating\Bundle\SkillBundle\Entity\Skill;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;

class SkillController extends Controller
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }


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
                "skills" => $this->getSkills($myMethod ? null : $request->query->get("name")),
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
            return [
                "errorMessage" => $this->translator->trans(
                    "myjobdating.message.error.missing",
                    [
                        "%property%" => $this->translator->trans("myjobdating.ui.name"),
                        "%resource%" => $this->translator->trans("myjobdating.ui.skill")
                    ]
                )
            ];
        }

        $mySkill = new Skill($myNewSkillName);

        $myEntityManager = $this->getDoctrine()->getManager();
        $myEntityManager->persist($mySkill);
        $myEntityManager->flush();

        return [
            "successMessage" => $this->translator->trans(
                "myjobdating.message.success.added",
                [
                    "%resource%" => $this->translator->trans("myjobdating.ui.skill"),
                    "%name%" => $myNewSkillName,
                    "%id%" => $mySkill->getId()
                ]
            )
        ];
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
            return [
                "errorMessage" => $this->translator->trans(
                    "myjobdating.message.error.missing",
                    [
                        "%property%" => "ID",
                        "%resource%" => $this->translator->trans("myjobdating.ui.skill")
                    ]
                )
            ];
        }

        if ( !$myNewSkillName ) {
            return [
                "errorMessage" => $this->translator->trans(
                    "myjobdating.message.error.missing",
                    [
                        "%property%" => $this->translator->trans("myjobdating.ui.name"),
                        "%resource%" => $this->translator->trans("myjobdating.ui.skill")
                    ]
                )
            ];
        }

        $myEntityManager = $this->getDoctrine()->getManager();
        $mySkill = $myEntityManager->find(Skill::class, $mySkillToUpdateId);
        $myPreviousSkillName = $mySkill->getName();

        $mySkill->setName($myNewSkillName);
        $myEntityManager->flush();

        return [
            "successMessage" => $this->translator->trans(
                "myjobdating.message.success.renamed",
                [
                    "%resource%" => $this->translator->trans("myjobdating.ui.skill"),
                    "%old_name%" => $myPreviousSkillName,
                    "%new_name%" => $myNewSkillName
                ]
            )
        ];
    }

    /**
     * @param ParameterBag $query
     * @return array
     */
    public function delete(ParameterBag $query): array
    {
        $mySkillToDeleteId = $query->get("id");

        if ( $mySkillToDeleteId === null ) {
            return [
                "errorMessage" => $this->translator->trans(
                    "myjobdating.message.error.missing",
                    [
                        "%property%" => "ID",
                        "%resource%" => $this->translator->trans("myjobdating.ui.skill")
                    ]
                )
            ];
        }

        $myManager = $this->getDoctrine()->getManager();
        $mySkill = $myManager->find(Skill::class, $mySkillToDeleteId);

        if ( !$mySkill ) {
            return [
                "errorMessage" => $this->translator->trans(
                    "myjobdating.message.error.unknown",
                    [
                        "%property%" => "ID",
                        "%resource%" => $this->translator->trans("myjobdating.ui.skill")
                    ]
                )
            ];
        }

        $myManager->remove($mySkill);
        $myManager->flush();

        return [
            "successMessage" => $this->translator->trans(
                "myjobdating.message.success.deleted",
                [
                    "%resource%" => $this->translator->trans("myjobdating.ui.skill"),
                    "%name%" => $mySkill->getName()
                ]
            )
        ];
    }
}
