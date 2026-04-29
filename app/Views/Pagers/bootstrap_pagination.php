<?php
// Pagination personnalisée Bootstrap
$paginationMarkup = '';

if ($pager) {
    $paginationMarkup = '<nav aria-label="Page navigation"><ul class="pagination">';
    
    // Bouton précédent
    if ($pager->hasPreviousPage()) {
        $paginationMarkup .= '<li class="page-item">
            <a class="page-link" href="' . $pager->getPreviousPage() . '" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>';
    } else {
        $paginationMarkup .= '<li class="page-item disabled">
            <span class="page-link">&laquo;</span>
        </li>';
    }
    
    // Pages
    foreach ($pager->links() as $link) {
        $paginationMarkup .= '<li class="page-item ' . (strpos($link, 'active') ? 'active' : '') . '">';
        $paginationMarkup .= $link;
        $paginationMarkup .= '</li>';
    }
    
    // Bouton suivant
    if ($pager->hasNextPage()) {
        $paginationMarkup .= '<li class="page-item">
            <a class="page-link" href="' . $pager->getNextPage() . '" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>';
    } else {
        $paginationMarkup .= '<li class="page-item disabled">
            <span class="page-link">&raquo;</span>
        </li>';
    }
    
    $paginationMarkup .= '</ul></nav>';
}

echo $paginationMarkup;
?>
