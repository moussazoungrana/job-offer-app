<?php

namespace App\Controller\Admin;

use App\Data\CategoryData;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/category")
 */
class CategoryController extends CrudController
{
    protected string $templatePath = 'category';

    protected string $entity = Category::class;
    protected string $routePrefix = 'admin_category';
    protected bool $indexOnSave = false;


    /**
     * @Route("/",name="admin_category_index")
     */
    public function index(): Response
    {
        return $this->crudIndex();
    }

    /**
     * @Route("/news", name="admin_category_new", methods={"GET","POST"})
     */
    public function new(): Response
    {
        $entity = new Category();
        $data = new CategoryData($entity);
        return $this->crudNew($data);
    }

    /**
     * @Route("/{id}/edit", name="admin_category_edit", methods={"GET","POST"})
     */
    public function edit(Category $category): Response
    {
        $data = (new CategoryData($category))->setEntityManager($this->em);
        return $this->crudEdit($data);
    }

    /**
     * @Route("/{id}/delete", name="admin_category_delete", methods={"POST"})
     */
    public function delete(Request $request, Category $category): Response
    {
        $token = $request->request->get('token');
        if (!$this->isCsrfTokenValid('delete', $token)) {
            return $this->redirectToRoute('admin_category_index');
        }
       return $this->crudDelete($category);
    }
}
