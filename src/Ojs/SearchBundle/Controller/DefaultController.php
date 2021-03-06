<?php

namespace Ojs\SearchBundle\Controller;

use Elastica\Result;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request,$page=1)
    {
        $data =[];
        $term = $request->get('q');
        $searchManager = $this->get('ojs_search_manager');
        $searchManager->addParam('term',$term);
        $searchManager->setPage($page);
        $result = $searchManager->search()->getResult();
        $data['result'] = $result;
        $data['total_count'] = $searchManager->getCount();
        $data['page'] = $searchManager->getPageCount();
        $data['page_count'] = $searchManager->getPageCount();
        $data['term'] = $term;
        return $this->render('OjsSiteBundle:Search:index.html.twig',$data);
    }


    public function tagAction(Request $request, $tag, $page = 1)
    {
        $data =[];
        $searchManager = $this->get('ojs_search_manager');
        $searchManager->addParam('term',$tag);
        $searchManager->setPage($page);
        $result = $searchManager->tagSearch();
        $data['results'] = $result;

        $data['tag'] =$tag;
        $data['total_count'] = $searchManager->getCount();
        return $this->render('OjsSiteBundle:Search:tags.html.twig',$data);
    }
}
