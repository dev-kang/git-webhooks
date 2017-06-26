<?php
/**
 * Created by PhpStorm.
 * User: DevKang
 * Date: 2017/6/22
 * Time: 00:28
 */

namespace Devkang\Git\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\Process\Process;

class WebhooksController extends BaseController
{

    /**
     *
     * @param Request $request
     * @return string
     */
    public function index(Request $request)
    {
        $projectPath = base_path();

        return $this->runLocalShell('git pull', $projectPath);
    }

    /**
     * 执行本地shell
     *
     * @author DevKang
     * @date 2016年7月20日
     */
    public function runLocalShell($cmd, $cwd = null)
    {
        $process = new Process($cmd);
        if ($cwd) {
            $process->setWorkingDirectory($cwd);
        }
        $process->run();

        if ($process->getExitCode() != 0) {
            return $process->getErrorOutput();
        }
        return $process->getOutput();
    }
}