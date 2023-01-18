<?php

namespace App\Controller\Admin;

use App\Admin\Field\VichImageField;
use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield Field::new('title');
        yield AssociationField::new('parent')->setRequired(false);
        yield TextEditorField::new('description')->hideOnIndex();
        yield DateTimeField::new('updatedAt')->setDisabled(true);
        
        yield VichImageField::new('imageFile');
    }
}
