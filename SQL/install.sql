###############################################################################################
# Mindestbestellwert Multilanguage Install - 2018-05-09 - webchills
###############################################################################################

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES 
('Minimum Order Amount', 'MIN_ORDER_AMOUNT', '20', 'The minimum amount an order must total to be able to checkout. Empty means no minimum.', '2', '99', NOW(), NULL, NULL),
('Minimum First Order Amount', 'MIN_FIRST_ORDER_AMOUNT', '50', 'The minimum amount a first order must total to be able to checkout. Empty means no minimum. Make it the same as the Minimum Order Amount, if you always want the same minimum.', '2', '99', NOW(), NULL, NULL);

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('Mindestbestellwert', 'MIN_ORDER_AMOUNT', 'Für Bestellungen unter dem hier eingestellen Mindestbestellwert ist kein Checkout möglich. Leer lassen, um keinen Mindestbestellwert zu verwenden', 43),
('Mindestbestellwert für Erstbestellung', 'MIN_FIRST_ORDER_AMOUNT', 'Für Erstbestellungen unter dem hier eingestellten Mindestbestellwert ist kein Checkout möglich. Wenn Sie grundsätzlich für alle Bestellungen denselben Mindestbestellwert haben wollen und nicht nach Erst- und Folgebestellung differenzieren wollen, dann stellen Sie hier denselben Wert ein wie oben bei Mindestbestellwert. Leer lassen um keinen Mindestbestellwert zu verwenden.', 43);