<?php
namespace Silexcane\Silex;

use Silexcane\Silex\Params;
use Valitron\Validator as V;

abstract class Validator
{
    protected $v;

    public function __construct($data, $lang = 'ja')
    {
        V::lang($lang);
        if ($data instanceof Params) {
            $data = $data->toArray();
        } elseif (!is_array($data)) {
            throw new \RuntimeException('$data should be array or Params')
        }
        $this->v = new V($data);
        $this->labels();
        $this->rules();
    }

    public function validate()
    {
        return $this->v->validate();
    }

    public function errors()
    {
        $errors = $this->v->errors();
        foreach ($errors as $i => $error) {
            $errors[$i] = array_shift($error);
        }
        return $errors;
    }

    public function error($field, $msg, array $params = [])
    {
        $this->v->error($field, $msg, $params);
    }

    protected abstract function labels();
    protected abstract function rules();
}
