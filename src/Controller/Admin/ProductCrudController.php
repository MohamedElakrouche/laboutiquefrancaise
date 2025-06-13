<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Name')->setLabel('Nom'),
            SlugField::new('slug')->setTargetFieldName('Name')->setHelp('URL du produit'),
           ImageField::new('Illustration')->setLabel('Image')->setHelp('Image du produit en 600x600')->setUploadDir('/public/uploads')->setBasePath('/uploads')->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]'),
           NumberField::new('Price')->setLabel('Prix')->setHelp('Prix HT du produit sans le €'),
           
           ChoiceField::new('tva')->setLabel('tva')-> setChoices([
            '5,5%'=>'5.5',
            '10%'=>'10',
            '20%'=>'20'
           ]),
           TextEditorField::new('Description')->setLabel('Description')->setHelp('La description du produit'),
           AssociationField::new('category', 'Catégorie associé')
        ];
    }
   
     public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Produit')
            ->setEntityLabelInPlural('Produits')
           
        ;
    }
}
