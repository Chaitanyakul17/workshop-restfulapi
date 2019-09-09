CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Installation
 * Configuration
 * Maintainers


INTRODUCTION
------------

 * This module provides following functionalities of Auto Tagging, Text Summarization
   and Duplicate Content Identification.

 * For a full description of the module, visit the project page:
   https://www.drupal.org/project/intelligent_tools

 * To submit bug reports and feature suggestions, or to track changes:
   https://www.drupal.org/project/issues/intelligent_tools


INSTALLATION
------------

 * Install the Intelligent Content Tools module as you would normally install a
   contributed Drupal module.

 * We prefer that you install this module using COMPOSER like run this
   command (composer require 'drupal/intelligent_tools:1.x-dev') in the
   Drupal site root folder.


CONFIGURATION
-------------

 * Place the module in modules folder of your drupal site.
 * Enable the Intelligent agents module and sub-modules i.e. Auto tag, Text
   Summarize, Duplicacy Check.

 * Instructions per submodule
   [Tagging]
    1. Enable intelligent agent module and auto tag module in your drupal site.
    2. Go to configuration -> Auto Tagging settings -> select fields and submit
       the form. Do make sure that the content type has field that is to be tagged
       in it, If not then add it in manage fields.
    3. For example: Content Type - Article, field to be used - body,
       field to be tagged - field_tags.
    4. Go to Content and add or edit the content form change body, Save it.
    5. The Tags will be reflected in the node display.

   [Summarize]
    1. Enable intelligent agent module and text summarize module in your drupal
       site.
    2. Go to configuration -> Text Summarize settings -> select fields and
       submit the form.
    3. For example: Content Type - Article, field to be used - body.
    4. Go to Content and add or edit the content form change body, Save it.
    5. The Summary Field will be reflected in the node display, which will be
       saved in database as field_summ field name.

   [Duplicity]
    1. Enable intelligent agent module and duplicity rate module in your drupal
       site.
    2. Go to configuration -> Duplicity Rate settings -> select fields and
       submit the form.
    3. For example: Content Type - Article, field to be used - body.
    4. Go to Content and add the content form change body, Save it.
    5. The Percent Duplicate Field will be reflected in the node display, which
       will be saved in database as field_dupl field name.

 * The changes will be reflected according to submodule(s) enabled.


MAINTAINERS
-----------

 * Gaurav Kapoor (gaurav.kapoor) - https://www.drupal.org/u/gauravkapoor

Supporting organizations:

 * OpenSense Labs - https://www.drupal.org/opensense-labs
