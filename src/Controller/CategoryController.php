<?php

// src/Controller/ProgramController.php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController

{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response

    {
            $categories = $categoryRepository->findAll();

            return $this->render('category/index.html.twig', [

                'categories' => $categories
         
             ]);

    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, CategoryRepository $categoryRepository): Response
    {
        // Create the new Category Object
        $category = new Category();
        // Create the associated form, linked with $category
        $form = $this->createForm(CategoryType::class, $category);
        // Get data from HTTP request
        $form->handleRequest($request);
        // Was the form submitted?
        if($form->isSubmitted()) {
            // Deal with the submitted data
            $categoryRepository->add($category, true);
        }
        // Render the form (best practice)
        return $this->renderForm('category/new.html.twig', 
        [ 'form' => $form, ]);
    }

    #[Route('/{categoryName}', methods: ['GET'], name: 'show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response

    {
        $category = $categoryRepository->findOneBy(['name' => $categoryName]);

        $programs = $programRepository->findBy(array('category' => $category), array('id' => 'DESC'), 3);

        return $this->render('category/show.html.twig', [
            
            'category' => $category,
            'programs' => $programs,
        
        ]);
    }
}