<?php

namespace App\Http\Controllers;

use App\Services\CnpjService;
use App\Repositories\FornecedorRepository;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    private $repository;
    private $cnpjService;

    public function __construct(FornecedorRepository $repository, CnpjService $cnpjService)
    {
        $this->repository = $repository;
        $this->cnpjService = $cnpjService;
    }

    public function buscarCnpj($cnpj)
    {
        $data = $this->cnpjService->buscarCnpj($cnpj);

        if (isset($data['error'])) {
            return response()->json(['error' => $data['error']], 400);
        }

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $data = $this->cnpjService->buscarCnpj($request->cnpj);
        dd($data['type']);
        if (isset($data['error'])) {
            return response()->json(['error' => $data['error']], 400);
        }
        $validated = $request->validate([
            'nome_fantasia' => 'required|string|max:255',
            'razao_social' => 'required|string|max:255',
            'cnpj' => 'required|unique:fornecedores',
            'email' => 'nullable|email',
            'telefone' => 'nullable|string',
            'endereco' => 'nullable|string',
        ]);

        $fornecedor = $this->repository->create($validated);

        return response()->json($fornecedor, 201);
    }

    public function index(Request $request)
    {
        $fornecedores = $this->repository->paginate($request->all());
        return response()->json($fornecedores);
    }

    public function show($id)
    {
        $fornecedor = $this->repository->findByCnpj($id);
        return response()->json($fornecedor);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nome_fantasia' => 'sometimes|required|string|max:255',
            'razao_social' => 'sometimes|required|string|max:255',
            'email' => 'nullable|email',
            'telefone' => 'nullable|string',
            'endereco' => 'nullable|string',
        ]);

        $fornecedor = $this->repository->update($id, $validated);

        return response()->json($fornecedor);
    }

    public function destroy($id)
    {
        $this->repository->delete($id);

        return response()->json(['message' => 'Fornecedor excluído com sucesso.']);
    }
}
