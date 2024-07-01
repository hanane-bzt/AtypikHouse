<?php
namespace App\Security\Voter;
use App\Entity\Habitat;
use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

use function PHPUnit\Framework\returnSelf;

class HabitaVoter extends Voter
{
    public const EDIT = 'HABITAT_EDIT';
    public const VIEW = 'HABITAT_VIEW';
    public const CREATE = 'HABITAT_CREATE';
    public const LIST = 'HABITAT_LIST';
    public const LIST_ALL = 'HABITAT_ALL';




    protected function supports(string $attribute, mixed $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return
            in_array($attribute, [self::CREATE,self::LIST,self::LIST_ALL]) ||
        (
            in_array($attribute,[self::EDIT, self::VIEW])
            && $subject instanceof \App\Entity\Habitat
        );
    }


    /**
    * @param Recipe | null $subject
    */
    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        // if the user is anonymous, do not grant access
        if (!$user instanceof User) {
            return false;
        }

        // if (!$subject instanceof Habitat) {
        //     return false;
        //     }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::EDIT:
                return $subject->getUser()->getId()===$user->getId();
                break;

            case self::VIEW:
            case self::LIST:
            case self::CREATE:

                // logic to determine if the user can VIEW
                return true;
                break;
        }

        return false;
    }
}

