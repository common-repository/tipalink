<?php

    if ( ! class_exists( 'Redux_Validation_preg_match' ) ) {
        class Redux_Validation_preg_match {

            /**
             * Field Constructor.
             * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
             *
             * @since ReduxFramework 1.0.0
             */
            function __construct( $parent, $field, $value, $current ) {

                $this->parent  = $parent;
                $this->field   = $field;
                $this->field['msg'] = ( isset( $this->field['msg'] ) ) ? $this->field['msg'] : __( 'You must provide a valid value for this field.', 'redux-framework' );
                $this->value   = $value;
                $this->current = $current;

                $this->validate();
            } //function

            /**
             * Field Render Function.
             * Takes the vars and validates them
             *
             * @since ReduxFramework 1.0.0
             */
            function validate() {
                 if (!preg_match('/' . preg_quote($this->field['pattern'], '/') . '/', $this->value)) {
                     $this->error = $this->field;
                     $this->value = ( isset( $this->current ) ) ? $this->current : '';
                 }
            } //function
        } //class
    }
