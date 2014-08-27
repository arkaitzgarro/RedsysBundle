<?php
/**
 * RedsysBundle for Symfony2
 *
 * This Bundle is part of Symfony2 Payment Suite
 *
 * @author Marc Morales Valldepérez <marcmorales83@gmail.com>
 * @author Gonzalo Vilseca <gonzalo.vilaseca@gmail.com>
 *
 */
namespace PaymentSuite\RedsysBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('redsys');

        $rootNode
            ->children()
                ->scalarNode('merchant_code')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('secret_key')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('url')
                    ->defaultValue('https://sis.redsys.es/sis/realizarPago')
                ->end()
                ->arrayNode('payment_success')
                    ->children()
                        ->scalarNode('route')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->booleanNode('order_append')
                            ->defaultTrue()
                        ->end()
                        ->scalarNode('order_append_field')
                            ->defaultValue('order_id')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('payment_fail')
                    ->children()
                        ->scalarNode('route')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->booleanNode('order_append')
                            ->defaultTrue()
                        ->end()
                        ->scalarNode('order_append_field')
                            ->defaultValue('order_id')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('controller_execute_route')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('en')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->defaultValue('/checkout/payment/redsys')
                        ->end()
                        ->scalarNode('es')
                            ->defaultValue('/procesar/pago/redsys')
                        ->end()
                        ->scalarNode('fr')
                            ->defaultValue('/acheter/paiement/redsys')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('controller_result_route')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('en')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->defaultValue('/checkout/payment/resultado')
                        ->end()
                        ->scalarNode('es')
                            ->defaultValue('/procesar/pago/result')
                        ->end()
                        ->scalarNode('fr')
                            ->defaultValue('/acheter/paiement/resultat')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
