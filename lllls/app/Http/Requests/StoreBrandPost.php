<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules()
    {
        return [
            'brand_name' => 'required|unique:brand|max:10',
            'brand_logo' => 'required',
            'brand_desc' => 'required',
            'brand_url' => 'required',
        ];
    }

    /**
    * 获取被定义验证规则的错误消息
    *
    * @return array
    * @translator laravelacademy.org
    */
    public function messages(){
        return [
            'brand_name.required' => '品牌名称必填',
            'brand_name.unique' => '品牌名称唯一',
            'brand_name.max' => '品牌名称最多10个字符',
            'brand_logo.required' => '品牌logo必填',
            'brand_desc.required' => '品牌描述必填',
            'brand_url.required' => '品牌网址必填',
        ];
    }

}
