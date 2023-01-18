<?php

namespace App\Controller\Admin;

use App\Admin\Field\VichFileField;
use App\Entity\Product;
use App\Form\ProductImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::addTab('Informations générales');
        yield AssociationField::new('category')->autocomplete();
        yield Field::new('name');
        yield MoneyField::new('price')->setCurrency('EUR')->setStoredAsCents(false);
        yield TextEditorField::new('description')->hideOnIndex();

        yield FormField::addTab('Images');
        yield CollectionField::new('productImages')
                ->setTemplatePath('admin/product/images.html.twig')
                ->setEntryType(ProductImageType::class);

        yield FormField::addTab('Documentation');
        yield VichFileField::new('manualFile');
                
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
        // ...
        ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}
