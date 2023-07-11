@props(['data' => '', 'loop' => ''])
{{ ($data->currentPage() - 1) * $data->perPage() + $loop->index + 1 }}