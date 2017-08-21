<?php

namespace Paysera\Bundle\CodeGeneratorBundle;

final class ResourcePatterns
{
    // /categories/{id}/elements
    const PATTERN_RESOURCE_NAME = '#^\/(?P<base_name>\w+)(?:.+\/(?P<sub_name>[\w|-]*)$)*#';

    // /categories/{id}
    const PATTERN_SINGULAR_RESOURCE = '#{(\w+)}$#';

    // /categories/{id}/*
    const PATTERN_IDENTIFIER_RESOURCE = '#{(\w+)}#';
}
