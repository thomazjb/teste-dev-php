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

    /**
     * @OA\Info(
     *     title="API de Fornecedores - ThomazJB",
     *     version="1.0.0"
     * )
     */

    /**
     * @OA\Get(
     *     path="api/fornecedores/buscar/{cnpj}",
     *     summary="Busca um CNPJ na BRASILAPI ",
     *     tags={"Fornecedores"},
     *     @OA\Parameter(
     *         description="CNPJ válido.",
     *         in="path",
     *         name="cnpj",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="int", value="19131243000197", summary="um cnpj sem caracteres especiais."),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Informações do CNPJ consultado.",
     *     )
     * )
     */

    public function buscarCnpj($cnpj)
    {
        $data = $this->cnpjService->buscarCnpj($cnpj);

        if (isset($data['error'])) {
            return response()->json(['error' => $data['error']], 400);
        }

        return response()->json($data);
    }

    /**
     * @OA\Post(
     *     path="/api/fornecedores",
     *     summary="Cria um novo fornecedor",
     *     tags={"Fornecedores"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nome_fantasia", "razao_social", "cnpj"},
     *             @OA\Property(property="nome_fantasia", type="string", example="LOJA MANEIRA"),
     *             @OA\Property(property="razao_social", type="string", example="RAZAO SOCIAL - ME"),
     *             @OA\Property(property="cnpj", type="int", example="19131243000197")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Fornecedor criado com sucesso",
     *     )
     * )
     */
    public function store(Request $request)
    {

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

    /**
     * @OA\Get(
     *     path="/api/fornecedores",
     *     summary="Lista todos os fornecedores",
     *     tags={"Fornecedores"},
     *     @OA\Parameter(
     *         description="Parâmetros de paginação.",
     *         in="query",
     *         name="page",
     *         required=false,
     *         @OA\Schema(type="integer", example=1),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de fornecedores",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="nome_fantasia", type="string", example="LOJA MANEIRA"),
     *                 @OA\Property(property="razao_social", type="string", example="RAZAO SOCIAL - ME"),
     *                 @OA\Property(property="cnpj", type="string", example="19131243000197")
     *             )
     *         )
     *     )
     * )
     */
    public function index(Request $request)
    {
        $fornecedores = $this->repository->paginate($request->all());
        return response()->json($fornecedores);
    }

    /**
     * @OA\Get(
     *     path="/api/fornecedores/{id}",
     *     summary="Exibe um fornecedor pelo ID",
     *     tags={"Fornecedores"},
     *     @OA\Parameter(
     *         description="ID do fornecedor",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer", example=1),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Fornecedor encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="nome_fantasia", type="string", example="LOJA MANEIRA"),
     *             @OA\Property(property="razao_social", type="string", example="RAZAO SOCIAL - ME"),
     *             @OA\Property(property="cnpj", type="string", example="19131243000197")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Fornecedor não encontrado"
     *     )
     * )
     */
    public function show($id)
    {
        $fornecedor = $this->repository->findByCnpj($id);
        return response()->json($fornecedor);
    }

    /**
     * @OA\Put(
     *     path="/api/fornecedores/{id}",
     *     summary="Atualiza um fornecedor existente",
     *     tags={"Fornecedores"},
     *     @OA\Parameter(
     *         description="ID do fornecedor",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer", example=1),
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nome_fantasia", "razao_social"},
     *             @OA\Property(property="nome_fantasia", type="string", example="LOJA MANEIRA"),
     *             @OA\Property(property="razao_social", type="string", example="RAZAO SOCIAL - ME"),
     *             @OA\Property(property="email", type="string", example="loja@exemplo.com"),
     *             @OA\Property(property="telefone", type="string", example="11987654321"),
     *             @OA\Property(property="endereco", type="string", example="Rua X, 123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Fornecedor atualizado com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="nome_fantasia", type="string", example="LOJA MANEIRA"),
     *             @OA\Property(property="razao_social", type="string", example="RAZAO SOCIAL - ME"),
     *             @OA\Property(property="email", type="string", example="loja@exemplo.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Fornecedor não encontrado"
     *     )
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/api/fornecedores/{id}",
     *     summary="Exclui um fornecedor pelo ID",
     *     tags={"Fornecedores"},
     *     @OA\Parameter(
     *         description="ID do fornecedor",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer", example=1),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Fornecedor excluído com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Fornecedor excluído com sucesso.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Fornecedor não encontrado"
     *     )
     * )
     */
    public function destroy($id)
    {
        $this->repository->delete($id);

        return response()->json(['message' => 'Fornecedor excluído com sucesso.']);
    }
}
