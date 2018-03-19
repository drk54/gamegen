<?php
/**
 * @file
 * Contains Drupal\welcome\Form\MessagesForm.
 */
namespace Drupal\guild_recruitment\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class GuildRecruitmentForm extends ConfigFormBase {

    protected function getEditableConfigNames() {
        return [
            'guild_recruitment.settings',
        ];
    }

    public function getFormId() {
        return 'guild_recruitment_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state) {

        $config = $this->config('guild_recruitment.settings');

        $thead = ['class', 'tank', 'heal', 'cac', 'cast'];
        $classes = ['war', 'warlock', 'shaman', 'rogue', 'priest', 'paladin', 'monk', 'mage', 'hunter', 'druid', 'dk'];
        $roles = ['tank', 'heal', 'dps'];

        $form['wrapper'] = array(
            '#prefix' => '<table>',
            '#suffix' => '</table>',
        );

        $form['wrapper']['head'] = array(
            '#prefix' => '<tr>',
            '#suffix' => '</tr>',
        );

        foreach( $thead as $title ){
            $form['wrapper']['head'][$title] = [
                '#markup' => $title,
                '#prefix' => '<th>',
                '#suffix' => '</th>',
            ];
        }


        foreach( $classes as $class ){
            $form['wrapper'][$class] = [
                '#prefix' => '<tr>',
                '#suffix' => '</tr>',
            ];
            $form['wrapper'][$class][$class] = [
                '#markup' => $class,
                '#prefix' => '<td>',
                '#suffix' => '</td>',
            ];
            foreach( $roles as $role ){
                $form['wrapper'][$class][$class.'_'.$role] = [
                    '#type' => 'checkbox',
                    '#prefix' => '<td>',
                    '#suffix' => '</td>',
                    '#default_value' => $config->get($class.'_'.$role)
                ];
            }
        };


        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        parent::submitForm($form, $form_state);

        $classes = ['war', 'warlock', 'shaman', 'rogue', 'priest', 'paladin', 'monk', 'mage', 'hunter', 'druid', 'dk'];
        $roles = ['tank', 'heal', 'dps'];

        foreach( $classes as $class ){
            foreach( $roles as $role ){
                $this->config('guild_recruitment.settings')->set($class.'_'.$role, $form_state->getValue($class.'_'.$role));
            }
        };

        $this->config('guild_recruitment.settings')->save();
    }

}