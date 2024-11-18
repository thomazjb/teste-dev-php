<?php

namespace App\Repositories;

use App\Models\Fornecedor;

class FornecedorRepository
{
    public function create(array $data)
    {
        return Fornecedor::create($data);
    }

    public function update(int $id, array $data)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->update($data);
        return $fornecedor;
    }

    public function delete(int $id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->delete();
    }

    public function findByCnpj(string $cnpj)
    {
        return Fornecedor::where('cnpj', $cnpj)->first();
    }

    public function paginate(array $filters, $perPage = 10)
    {
        $query = Fornecedor::query();

        if (isset($filters['search'])) {
            $query->where('nome_fantasia', 'like', '%' . $filters['search'] . '%');
        }

        return $query->paginate($perPage);
    }
}
