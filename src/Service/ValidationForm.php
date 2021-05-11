<?php

namespace App\Service;

class ValidationForm
{
    private array $constraint;
    private array $dataForm;

    public function __construct(array $constraint, array $dataForm)
    {
        $this->constraint = $constraint;
        $this->dataForm = $dataForm;
    }

    public function validate(): array
    {
        return array_merge(
            $this->isEmpty(),
            $this->inputMaxLength(),
            $this->filterVar()
        );
    }

    /**
     * Control if field is empty
     *
     * @return array
     */
    private function isEmpty(): array
    {
        $errors = [];
        foreach ($this->constraint as $inputName => $constraint) {
            if (empty($this->dataForm[$inputName])) {
                $errors[] = $constraint['phrasing_start'] . ' must be defined.';
            }
        }

        return $errors;
    }

    /**
     * control the input max length if is defined
     *
     * @return array
     */
    private function inputMaxLength(): array
    {
        $errors = [];
        foreach ($this->dataForm as $dataKey => $dataValue) {
            if (array_key_exists($dataKey, $this->constraint)) {
                if (!empty($this->dataForm[$dataKey]) && isset($this->constraint[$dataKey]['max_length'])) {
                    if (strlen($dataValue) > $this->constraint[$dataKey]['max_length']) {
                        $errors[] = $this->constraint[$dataKey]['phrasing_start'] .
                        ' must be less than ' .
                        $this->constraint[$dataKey]['max_length'] .
                        ' characters';
                    }
                }
            }
        }

        return $errors;
    }

    /**
     * control the filter if is defined
     *
     * @return array
     */
    private function filterVar(): array
    {
        $errors = [];
        foreach ($this->dataForm as $dataKey => $dataValue) {
            if (array_key_exists($dataKey, $this->constraint)) {
                if (!empty($this->dataForm[$dataKey])) {
                    if (isset($this->constraint[$dataKey]['filter_var'])) {
                        if (!filter_var($dataValue, $this->constraint[$dataKey]['filter_var'])) {
                            $errors[] = $this->constraint[$dataKey]['phrasing_start'] . ' is not in the right format.';
                        }
                    }
                }
            }
        }

        return $errors;
    }
}
