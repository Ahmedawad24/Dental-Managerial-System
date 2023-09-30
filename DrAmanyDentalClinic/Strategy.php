<?php

        class StrategyContext
        {
            private $strategy = NULL;
            public function __construct($strategy_ind_id) {
                switch ($strategy_ind_id) {
                    case "Cash":
                        $this->strategy = new StrategyCaps();
                        break;
                    
                    case "Credit Card":
                        $this->strategy = new StrategyExclaim();
                        break;
                }
            }

            public function showPaymentMethod($Method) {
                return $this->strategy->showMethod($Method);
            }
        }

        interface IStrategy {
            public function showMethod($method_in);
        }
        
        class CashMethod implements IStrategy {
            public function showMethod($cash_in) {
                $Method = $cash_in->getPaymentMethod();
                return "Paid In Cash";
            }
        }
        
        class CreditCardMethod implements IStrategy {
            public function showMethod($credit_in) {
                $Method = $credit_in->getPaymentMethod();
                return "Paid In Credit Card";
            }
        }
        
        class Method {
            private $PaymntMethod;
            function __construct($PaymntMethod) {
                $this->PaymntMethod = $PaymntMethod;
            }

            function getPaymentMethod() {
                return $this->PaymntMethod;
            }
        }

?>