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

        return array(
            '#type' => 'markup',
            '#markup' => 'This block list the article.',
        );
    }

}