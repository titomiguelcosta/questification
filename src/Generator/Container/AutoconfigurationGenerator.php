<?php

namespace App\Generator\Container;

use App\Category;
use App\Generator\GeneratorInterface;
use App\Question\ExactAnswerQuestion;
use App\Question\QuestionInterface;

class AutoconfigurationGenerator implements GeneratorInterface
{
    private $questionsGenerated = 0;
    private $data;
    private $asked = [];

    public function __construct()
    {
        // @see https://github.com/symfony/symfony/blob/4.3/src/Symfony/Bundle/FrameworkBundle/DependencyInjection/FrameworkExtension.php#L356
        $this->data = [
            'AbstractController::class' => 'controller.service_arguments',
            'ArgumentValueResolverInterface::class' => 'controller.argument_value_resolver',
            'CacheClearerInterface::class' => 'kernel.cache_clearer',
            'CacheWarmerInterface::class' => 'kernel.cache_warmer',
            'Command::class' => 'console.command',
            'ConstraintValidatorInterface::class' => 'validator.constraint_validator',
            'DataCollectorInterface::class' => 'data_collector',
            'DecoderInterface::class' => 'serializer.encoder',
            'DenormalizerInterface::class' => 'serializer.normalizer',
            'EncoderInterface::class' => 'serializer.encoder',
            'EnvVarProcessorInterface::class' => 'container.env_var_processor',
            'EventSubscriberInterface::class' => 'kernel.event_subscriber',
            'FormTypeInterface::class' => 'form.type',
            'FormTypeGuesserInterface::class' => 'form.type_guesser',
            'FormTypeExtensionInterface::class' => 'form.type_extension',
            'LocaleAwareInterface::class' => 'kernel.locale_aware',
            'MessageHandlerInterface::class' => 'messenger.message_handler',
            'MimeTypeGuesserInterface::class' => 'mime.mime_type_guesser',
            'NormalizerInterface::class' => 'serializer.normalizer',
            'ObjectInitializerInterface::class' => 'validator.initializer',
            'PropertyListExtractorInterface::class' => 'property_info.list_extractor',
            'PropertyTypeExtractorInterface::class' => 'property_info.type_extractor',
            'PropertyDescriptionExtractorInterface::class' => 'property_info.description_extractor',
            'PropertyAccessExtractorInterface::class' => 'property_info.access_extractor',
            'PropertyInitializableExtractorInterface::class' => 'property_info.initializable_extractor',
            'ResetInterface::class' => 'kernel.reset',
            'ResourceCheckerInterface::class' => 'config_cache.resource_checker',
            'ServiceLocator::class' => 'container.service_locator',
            'ServiceSubscriberInterface::class' => 'container.service_subscriber',
            'TransportFactoryInterface::class' => 'messenger.transport_factory',
        ];
    }

    public function generate(?Category $category = null): ?QuestionInterface
    {
        ++$this->questionsGenerated;

        $unasked = array_diff(array_keys($this->data), $this->asked);
        $class = $unasked[array_rand($unasked)];
        $this->asked[] = $class;

        $ask = sprintf('What is the tag that gets added to instances of "%s"?', $class);

        $question = new ExactAnswerQuestion($ask, $this->data[$class]);
        $question->setCategory(Category::CONTAINER);

        return $question;
    }

    public function supportsCategory(Category $category): bool
    {
        return Category::CONTAINER === $category;
    }

    public function hasQuestions(?Category $category = null): bool
    {
        return $this->questionsGenerated < count($this->data);
    }
}