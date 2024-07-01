<?php
// src/Security/Voter/CategoryVoter.php
namespace App\Security\Voter;

use App\Entity\Category;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class CategoryVoter extends Voter
{
    public const LIST = 'list';
    public const CREATE = 'create';
    public const EDIT = 'edit';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, [self::LIST, self::CREATE, self::EDIT])
            && ($subject instanceof Category || $subject === null);
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        // Seuls les administrateurs ont accès aux actions sur les catégories
        return in_array('ROLE_ADMIN', $user->getRoles());
    }
}
