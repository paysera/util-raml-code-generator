<?php

namespace Paysera\Bundle\CodeGeneratorBundle;

final class ResourcePatterns
{
    // /categories/{id}
    const PATTERN_SINGULAR_RESOURCE = '#{(\w+)}$#';

    // /categories/{id}/*
    const PATTERN_IDENTIFIER_RESOURCE = '#{(\w+)}#';
}
