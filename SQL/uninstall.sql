#############################################################################################
# Mindestbestellwert UNINSTALL - 2018-05-09 - webchills
# NUR AUSFÜHREN FALLS SIE DAS MODUL VOLLSTÄNDIG ENTFERNEN WOLLEN!!!
#############################################################################################

DELETE FROM configuration WHERE configuration_key = 'MIN_ORDER_AMOUNT';
DELETE FROM configuration_language WHERE configuration_key = 'MIN_ORDER_AMOUNT';
DELETE FROM configuration WHERE configuration_key = 'MIN_FIRST_ORDER_AMOUNT';
DELETE FROM configuration_language WHERE configuration_key = 'MIN_FIRST_ORDER_AMOUNT';