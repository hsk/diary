(declare-const a Int)
(declare-const b Int)

(assert (= b 4))
(assert (= (+ a b) 10))
(check-sat)
(get-value (a b))
(exit)

