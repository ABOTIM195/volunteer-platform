<?php
public function rules()
{
    return [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'type' => 'required|in:volunteer,help',
        'target_amount' => 'nullable|numeric|min:0',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'image' => 'nullable|image|max:2048', // تأكد من أن هذا الحقل موجود
        // تأكد من وجود جميع الحقول الأخرى المطلوبة
    ];
}