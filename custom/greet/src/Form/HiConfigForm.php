<?php

namespace Drupal\greet\form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Path\CurrentPathStack;

use Drupal\Core\Logger\LoggerChannelInterface;

class HiConfigForm extends ConfigFormBase {
    protected $cu;
    protected $cp;

    protected $logger;

    public static function create(ContainerInterface $container) {
        return new static(
            $container->get('current_user'),
            $container->get('path.current'),
            $container->get('greet.logger.channel.greet'),
        );
    }

    public function __construct(AccountProxyInterface $current_users, CurrentPathStack $cp, LoggerChannelInterface $logger) {
        $this->cu = $current_users;
        $this->cp = $cp;
        $this->logger = $logger;
    }

    protected function getEditableConfigNames() {
        return ['greeting.custom_greeting'];
    }

    public function getFormId() {
        return 'custom_greeting_isformID';
    }

    public function buildForm(array $form, FormStateInterface $form_state) {
        $config = $this->config('greeting.custom_greeting');

        $form['greet'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Enter your custom greeting message'),
            '#description' => $this->t('user name is @id and current path is @cp', [
                '@id' => $this->cu->getUsername(),
                '@cp' => $this->cp->getPath(),
            ]),
            '#default_value' => $config->get('greet'),
        );
        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        $this->config('greeting.custom_greeting')
        ->set('greet', $form_state->getValue('greet'))
        ->save();
        parent::submitForm($form, $form_state);

        // let's log
        $this->logger->info('greet message has been updated..');
    }

    public function validateForm(array &$form, FormStateInterface $form_state) {
        $greet = $form_state->getValue('greet');
        if (strlen($greet) < 10) {
            $form_state->setErrorByName('greet', $this->t('your greet @length, which is too short', [
                '@length' => strlen($greet)
            ]));
        }
    }

}