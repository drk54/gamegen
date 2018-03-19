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

        foreach ($classes as $class){
            $content[$class]['class'] = $class;
            foreach ($roles as $role){
                $content[$class]['role'][$role][] = $role;
                $content[$class]['role'][$role][] = $config->get($class.'_'.$role);
            }
        }
        return array(
            '#content' => $content,
        );
    }

}