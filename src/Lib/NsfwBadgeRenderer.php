<?php

namespace Siezi\SaitoNsfwBadge\Lib;

use App\Model\Table\EntriesTable;
use Saito\Event\SaitoEventListener;

/**
 * Class NsfwBadgeRenderer
 */
class NsfwBadgeRenderer implements SaitoEventListener
{
    protected $_badge;

    // const CSS = '.posting-badge-nsfw { color: #FFF; background-color: #F00; }';

    public function implementedSaitoEvents()
    {
        return [
            'Event.Saito.Model.initialize' => 'initModels',
            // 'Event.Saito.View.beforeRender' => 'viewBeforeRender',
            'Request.Saito.View.Posting.addForm' => 'postingAdd',
            'Request.Saito.View.Posting.badges' => 'nsfwBadge'
        ];
    }

    /*
    public function viewBeforeRender($eventData)
    {
        $View = $eventData['subject'];
        $View->append('css', '<style>' . self::CSS . '</style>');

        // we assume that an answers to a nsfw posting isn't nsfw itself
        if ($View->request->getParam('action') === 'add' && $View->request->getParam('controller') === 'Entries') {
            unset($View->request->data['Entry']['nsfw']);
        }
    }
    */

    public function initModels($eventData)
    {
        /** @var EntriesTable $Model */
        $Model = $eventData['subject'];
        if ($Model->getAlias() !== 'Entries') {
            return;
        }

        $Model->threadLineFieldList[] = 'Entries.nsfw';

        //= allows nswfw field in Entry::create() and Entry::update()
        $Model->fieldFilter->setConfig('create', ['nsfw']);
        $Model->fieldFilter->setConfig('update', ['nsfw']);
    }

    public function nsfwBadge($eventData)
    {
        if (empty($eventData['posting']['nsfw'])) {
            return;
        }
        if (!$this->_badge) {
            $this->_badge = '<span class="posting-badge badge-danger" title="' .
                __d('siezi/saito_nsfw_badge', 'nsfw.exp') . '">' . __d(
                    'siezi/saito_nsfw_badge',
                    'nsfw.title'
                ) .
                '</span> ';
        }
        return $this->_badge;
    }

    public function postingAdd($eventData)
    {
        /** @var AppView $View */
        $View = $eventData['View'];

        $checkbox = $View->Form->control(
            'nsfw',
            [
                'type' => 'checkbox',
                'class' => 'form-check-input',
                'label' => [
                    'text' => __d('siezi/saito_nsfw_badge', 'nsfw.exp')
                ],
            ]
        );
        $tag = $View->Html->div('form-group form-check', $checkbox);

        return $tag;
    }
}
