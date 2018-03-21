<?php
/**
 * @file
 * Contains \Drupal\article\Plugin\Block\XaiBlock.
 */
namespace Drupal\guild_recruitment\Plugin\Block;
use Drupal\Core\Block\BlockBase;
/**
 * Provides a 'article' block.
 *
 * @Block(
 *   id = "guild_recruitment_block",
 *   admin_label = @Translation("Guild Recruitment")
 * )
 */
class GuildRecruitmentBlock extends BlockBase {

    public function build() {

        $config = \Drupal::config('guild_recruitment.settings');

        $classes = ['war', 'warlock', 'shaman', 'rogue', 'priest', 'paladin', 'monk', 'mage', 'hunter', 'druid', 'dk', 'dh'];
        $roles = ['tank', 'heal', 'dps'];

        $content = [];

        foreach ($roles as $role){
            $content[$role]['role'] = $role;
            foreach ($classes as $class){
                $content[$role]['class'][$class][] = $class;
                $content[$role]['class'][$class][] = $config->get($class.'_'.$role);
            }
        }

        return array(
            '#content' => $content,
        );
    }

}