<?php

/*
 * This file is part of the Rollerworks Search Component package.
 *
 * (c) Sebastiaan Stok <s.stok@rollerscapes.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Rollerworks\Component\Search\Extension\Core\ChoiceList;

use PhpSpec\ObjectBehavior;

class SimpleChoiceListSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(array(
            'creditcard' => 'credit-card-payment',
            'cash' => 'cash-payment',
        ));
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Rollerworks\Component\Search\Extension\Core\ChoiceList\SimpleChoiceList');
    }

    public function it_returns_the_choice_by_value()
    {
        $this->getChoiceForValue('creditcard')->shouldReturn('creditcard');
        $this->getChoiceForValue('cash')->shouldReturn('cash');
    }

    public function its_choice_returns_null_when_the_value_is_not_set()
    {
        $this->getChoiceForValue('paypal')->shouldReturn(null);
    }

    public function it_returns_the_choice_by_label()
    {
        $this->getChoiceForLabel('credit-card-payment')->shouldReturn('creditcard');
        $this->getChoiceForLabel('cash-payment')->shouldReturn('cash');
    }

    public function its_choice_returns_null_when_the_label_is_not_set()
    {
        $this->getChoiceForValue('paypal')->shouldReturn(null);
    }

    public function it_returns_the_label_by_choice()
    {
        $this->getLabelForChoice('creditcard')->shouldReturn('credit-card-payment');
        $this->getLabelForChoice('cash')->shouldReturn('cash-payment');
    }

    public function its_label_returns_null_when_the_choice_is_not_set()
    {
        $this->getLabelForChoice('paypal')->shouldReturn(null);
    }
}
