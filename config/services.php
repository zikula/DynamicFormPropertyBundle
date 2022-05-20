<?php

declare(strict_types=1);

/*
 * This file is part of the Zikula package.
 *
 * Copyright Zikula - https://ziku.la/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Zikula\Bundle\DynamicFormPropertyBundle\EventSubscriber\FormTypeChoiceEventSubscriber;
use Zikula\Bundle\DynamicFormPropertyBundle\Form\Type\DynamicFieldType;
use Zikula\Bundle\DynamicFormPropertyBundle\Form\Type\InlineFormDefinitionType;
use Zikula\Bundle\DynamicFormPropertyBundle\Form\Type\TranslationCollectionType;
use Zikula\Bundle\DynamicFormPropertyBundle\Provider\LocaleProvider;

return static function (ContainerConfigurator $container) {

    $container->services()
        ->set('zikula.dynamic_form.event_subscriber.form_type_choice_event_subscriber', FormTypeChoiceEventSubscriber::class)
            ->args([
                service('translator')
            ])
            ->tag('kernel.event_subscriber')

        ->set('zikula.dynamic_form.form_type.dynamic_form_field_type', DynamicFieldType::class)
            ->args([
                service('event_dispatcher')
            ])
            ->tag('form.type')

        ->set('zikula.dynamic_form.form_type.inline_form_definition_type', InlineFormDefinitionType::class)
            ->args([
                service('translator')
            ])
            ->tag('form.type')

        ->set('zikula.dynamic_form.form_type.translation_collection_type', TranslationCollectionType::class)
            ->args([
                service('zikula.dynamic_form.provider.locale_provider')
            ])
            ->tag('form.type')

        ->set('zikula.dynamic_form.provider.locale_provider', LocaleProvider::class)
            ->args([
                service('event_dispatcher')
            ])
    ;
};
