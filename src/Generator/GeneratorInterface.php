<?php

namespace App\Generator;

use App\Category;
use App\Question\QuestionInterface;

interface GeneratorInterface
{
    public function generate(?Category $category = null): ?QuestionInterface;

    public function supportsCategory(Category $category): bool;

    public function hasQuestions(?Category $category = null): bool;
}
